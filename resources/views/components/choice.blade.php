<div class="mt-4 relative">
    <x-label for="choices" :value="__('Choice')" />
    <x-input @change="fields.push(index++)" id="choices" class="block mt-1 w-full" type="text" name="choices[]" required autocomplete="choices" />

    <template x-if="field>1">
        <button type="button" @click="fields = fields.filter(i => i !== field)" class="absolute bg-red-500 text-white px-1 py-0.25 top-3 -right-1 flex items-center rounded"> x </button>
    </template>
</div>