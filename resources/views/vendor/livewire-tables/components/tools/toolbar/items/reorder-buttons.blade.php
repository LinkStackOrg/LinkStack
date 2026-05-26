@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5','localisationPath'])
<div x-data x-cloak x-show="reorderStatus"
    @class([
        'mr-0 mr-md-2 mb-3 mb-md-0' => $isBootstrap4,
        'me-0 me-md-2 mb-3 mb-md-0' => $isBootstrap5
    ])
>
    <button
        x-on:click="reorderToggle"
        type="button"
        @class([
            'btn btn-default d-block d-md-inline' => $isBootstrap,
            'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind
        ])
    >
        <span x-cloak x-show="currentlyReorderingStatus">
         {{ __($localisationPath.'cancel') }}
        </span>

        <span x-cloak x-show="!currentlyReorderingStatus">
        {{ __($localisationPath.'Reorder') }}
        </span>

    </button>
    
    <div :class="{ 'inline d-inline' : currentlyReorderingStatus }" x-cloak x-show="currentlyReorderingStatus" >
        <button
            type="button"
            x-on:click="updateOrderedItems"
            @class([
                'btn btn-default d-block d-md-inline' => $isBootstrap && $this->currentlyReorderingStatus,
                'inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind
            ])
        >
            <span>
            {{ __($localisationPath.'save') }}
            </span>
        </button>
    </div>


</div>
