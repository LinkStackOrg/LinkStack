<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;

class LinkType extends Model
{
    protected $fillable = ['id', 'typename', 'title', 'description', 'icon', 'custom_html', 'ignore_container', 'include_libraries'];

    // Assuming no database interaction, we can disable timestamps
    public $timestamps = false;

    /**
     * Get all LinkTypes from the config.yml files in each subfolder of the blocks directory.
     *
     * @return Collection
     */
    public static function get()
    {
        $blocksPath = base_path('blocks/');
        $directories = (new Filesystem)->directories($blocksPath);
        $linkTypes = collect();
    
    // Prepend "predefined" entry to the $linkTypes list
    $predefinedLinkType = new self([
        'id' => 1,
        'typename' => 'predefined',
        'title' => null,
        'description' => null,
        'icon' => 'bi bi-boxes',
        'custom_html' => false,
        'ignore_container' => false,
        'include_libraries' => [],
    ]);

    $linkTypes->prepend($predefinedLinkType);

    foreach ($directories as $dir) {
        $configPath = $dir . '/config.yml';
        if (file_exists($configPath)) {
            $configData = Yaml::parse(file_get_contents($configPath));

            // Create a new instance of LinkType for each config file
            $linkType = new self([
                'id' => $configData['id'] ?? 0,
                'typename' => $configData['typename'] ?? null,
                'title' => $configData['title'] ?? null,
                'description' => $configData['description'] ?? null,
                'icon' => $configData['icon'] ?? null,
                'custom_html' => $configData['custom_html'] ?? false,
                'ignore_container' => $configData['ignore_container'] ?? false,
                'include_libraries' => $configData['include_libraries'] ?? [],
            ]);
            $linkTypes->push($linkType);
        }
    }
    
        $custom_order = [
            'predefined',
            'link',
            'vcard',
            'email',
            'telephone',
            'heading',
            'spacer',
            'text',
        ];
    
        $sorted = $linkTypes->sortBy(function ($item) use ($custom_order) {
            $index = array_search($item->typename, $custom_order);
            return $index !== false ? $index : count($custom_order);
        });
    
        return $sorted->values();
    }

    /**
     * Check if a LinkType with the given typename exists.
     *
     * @param string $typename
     * @return bool
     */
    public static function existsByTypename($typename)
    {
        return self::get()->contains('typename', $typename);
    }

    /**
     * Find a LinkType by its typename.
     *
     * @param string $typename
     * @return LinkType|null
     */
    public static function findByTypename($typename)
    {
        return self::get()->firstWhere('typename', $typename);
    }
}
