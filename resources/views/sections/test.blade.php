<div data-vue class="bg-gray-800 py-3 text-center text-white">
  Some content here
  <x-shop::button title="{{ $section->settings->text }}" :raw-attributes="$section->liveUpdate()->text('text')" />
</div>
