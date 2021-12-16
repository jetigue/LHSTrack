@props(['active'])

<div
    @register-tab.stop="headings.push($event.detail.name)"
    x-data="{
    activeTab: '{{ $active }}',
    headings: [],
  }"
>

    <div class="mb-3"
         role="tablist"
    >
        <template x-for="(tab, index) in headings"
                  :key="index"
        >
            <button x-text="tab"
                    @click="activeTab = tab; console.log(activeTab);"
                    class="px-4 py-1 text-sm rounded hover:bg-blue-500 hover:text-white"
                    :class="tab === activeTab ? 'bg-blue-500 text-white' : 'text-gray-800'"
                    :id="`tab-${index + 1}`"
                    role="tab"
                    :aria-selected="(tab === activeTab).toString()"
                    :aria-controls="`tab-panel-${index + 1}`"
            ></button>
        </template>
    </div>

    <div x-ref="tabs">
        {{$slot}}
    </div>
</div>
