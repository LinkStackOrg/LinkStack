<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\Link;
use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

/**
 * Application config declares global helpers, so each boot needs a fresh process.
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class ImportDataTest extends TestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite.database', ':memory:');
        $app['config']->set('session.driver', 'array');
        $app['config']->set('cache.default', 'array');
        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--class' => 'ButtonSeeder', '--force' => true]);
        $user = User::create(['name' => 'Import User', 'email' => 'import@example.test', 'password' => 'test-only']);
        Auth::setUser($user);
        $link = new Link(['title' => 'Existing', 'link' => 'https://example.test', 'button_id' => 1, 'type' => 'link']);
        $link->user_id = $user->id;
        $link->save();
    }

    private function import(array $data): void
    {
        $file = UploadedFile::fake()->createWithContent('links.json', json_encode($data, JSON_THROW_ON_ERROR));
        $request = Request::create('/import', 'POST', [], [], ['import' => $file]);
        (new UserController())->importData($request);
    }

    public function testImportsContactJsonWithoutChangingItsContents(): void
    {
        $row = Link::first()->toArray();
        $row['type'] = 'vcard';
        $row['button_id'] = 96;
        $row['link'] = json_encode(['first_name' => 'Example', 'organization' => 'A "Quoted" Company']);
        $ordinary = Link::first()->toArray();
        $this->import(['links' => [$ordinary, $row]]);
        $this->assertTrue(session()->has('success'));
        $this->assertSame(2, Link::count());
        $this->assertSame($row['link'], Link::where('type', 'vcard')->sole()->link);
        $this->assertSame($ordinary['link'], Link::where('type', 'link')->sole()->link);
    }

    /** @dataProvider invalidLinks */
    public function testRejectsInvalidLinksBeforeChangingExistingData($type, $value): void
    {
        $original = Link::first()->toArray();
        $invalid = $original;
        $invalid['type'] = $type;
        $invalid['link'] = $value;
        $this->import(['name' => 'Changed Name', 'links' => [$original, $invalid]]);
        $this->assertTrue(session()->has('error'));
        $this->assertSame([$original], Link::all()->toArray());
        $this->assertSame('Import User', Auth::user()->fresh()->name);
    }

    public static function invalidLinks(): array
    {
        return [
            'broken json' => ['vcard', '{'],
            'array json' => ['vcard', '[]'],
            'scalar json' => ['vcard', '42'],
            'null json' => ['vcard', 'null'],
            'empty contact' => ['vcard', ''],
            'non-string contact' => ['vcard', ['first_name' => 'Example']],
            'ordinary invalid url' => ['link', 'javascript:alert(1)'],
        ];
    }

    public function testStillImportsOrdinaryLinks(): void
    {
        $row = Link::first()->toArray();
        $row['link'] = 'mailto:person@example.test';
        $this->import(['links' => [$row]]);
        $this->assertTrue(session()->has('success'));
        $this->assertSame($row['link'], Link::sole()->link);
    }

    /** @dataProvider invalidExports */
    public function testRejectsMalformedExportStructureBeforeChangingData(array $data): void
    {
        $original = Link::first()->toArray();
        $this->import($data);
        $this->assertTrue(session()->has('error'));
        $this->assertSame([$original], Link::all()->toArray());
    }

    public static function invalidExports(): array
    {
        return [
            'missing links' => [[]],
            'non-array links' => [['links' => 'invalid']],
            'non-array row' => [['links' => [42]]],
        ];
    }

    public function testAllowsAnEmptyLinkExport(): void
    {
        $this->import(['links' => []]);
        $this->assertTrue(session()->has('success'));
        $this->assertSame(0, Link::count());
    }
}
