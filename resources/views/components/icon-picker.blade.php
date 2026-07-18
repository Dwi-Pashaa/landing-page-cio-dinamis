@props(['name', 'value' => '', 'label' => 'Icon', 'id' => null, 'required' => false])

@php
    $icons = config('icons', []);
    $pickerId = $id ?? 'icon_picker_' . str_replace(['[', ']'], '_', $name);
    $selectedIcon = collect($icons)->firstWhere('class', $value);
@endphp

<div
    x-data="iconPicker('{{ $value }}', {{ json_encode($icons) }})"
    class="icon-picker-wrapper"
>
    <label class="form-label" for="{{ $pickerId }}_input">
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>

    <input type="hidden" name="{{ $name }}" x-model="selected" :value="selected">

    <div class="icon-picker-trigger" @click="toggle()" :class="{ 'is-open': open }">
        <template x-if="selected && !isCustom(selected)">
            <span class="icon-picker-selected-icon">
                <i class="fa-solid" :class="selected"></i>
            </span>
        </template>
        <template x-if="!selected || isCustom(selected)">
            <span class="icon-picker-selected-icon icon-picker-no-icon">
                <i class="fa-solid fa-icons"></i>
            </span>
        </template>
        <span class="icon-picker-selected-label" x-text="getLabel()">Pilih Icon</span>
        <span class="icon-picker-chevron">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </div>

    <div class="icon-picker-dropdown" x-show="open" @click.outside="open = false" x-cloak>
        <div class="icon-picker-search">
            <i class="fa-solid fa-magnifying-glass icon-picker-search-icon"></i>
            <input
                type="text"
                class="form-control"
                x-model="search"
                placeholder="Cari icon..."
                @click.stop
            >
            <button
                type="button"
                class="icon-picker-custom-toggle"
                @click.stop="toggleCustom()"
                :class="{ 'active': customMode }"
                title="Custom class"
            >
                <i class="fa-solid fa-pen"></i>
            </button>
        </div>

        <template x-if="customMode">
            <div class="icon-picker-custom-input">
                <input
                    type="text"
                    class="form-control"
                    x-model="customValue"
                    placeholder="fa-nama-icon"
                    @input="selected = customValue"
                    @click.stop
                >
                <small class="text-muted mt-1 d-block">Ketik nama class icon FontAwesome manual</small>
            </div>
        </template>

        <template x-if="!customMode">
            <div class="icon-picker-grid">
                <template x-for="icon in filteredIcons" :key="icon.class">
                    <div
                        class="icon-picker-item"
                        :class="{ 'selected': selected === icon.class }"
                        @click="selectIcon(icon.class)"
                    >
                        <i class="fa-solid" :class="icon.class"></i>
                        <span class="icon-picker-item-label" x-text="icon.label"></span>
                    </div>
                </template>
                <div class="icon-picker-no-results" x-show="filteredIcons.length === 0">
                    <i class="fa-solid fa-face-frown"></i>
                    <span>Tidak ada icon yang cocok</span>
                </div>
            </div>
        </template>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('iconPicker', (initialValue, iconsList) => ({
            open: false,
            search: '',
            selected: initialValue || '',
            customMode: false,
            customValue: '',

            init() {
                if (this.selected && !iconsList.some(i => i.class === this.selected)) {
                    this.customMode = true;
                    this.customValue = this.selected;
                }
            },

            get filteredIcons() {
                const q = this.search.toLowerCase();
                return iconsList.filter(icon =>
                    icon.class.toLowerCase().includes(q) ||
                    icon.label.toLowerCase().includes(q)
                );
            },

            toggle() {
                this.open = !this.open;
                if (this.open) {
                    this.search = '';
                }
            },

            selectIcon(cls) {
                this.selected = cls;
                this.customMode = false;
                this.customValue = '';
                this.open = false;
            },

            toggleCustom() {
                this.customMode = !this.customMode;
                if (this.customMode) {
                    this.customValue = this.selected;
                } else {
                    this.customValue = '';
                    if (!iconsList.some(i => i.class === this.selected)) {
                        this.selected = '';
                    }
                }
                this.search = '';
            },

            isCustom(cls) {
                return cls && !iconsList.some(i => i.class === cls);
            },

            getLabel() {
                if (!this.selected) return 'Pilih Icon...';
                const found = iconsList.find(i => i.class === this.selected);
                if (found) return found.label;
                return this.selected + ' (custom)';
            }
        }))
    })
</script>
@endpush
