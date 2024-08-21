
// Brands searchbar dropdown
let brands_list = document.getElementsByName('brands_list_item');
let brand_id = document.getElementById('brand_id');
let search_brand_input = document.getElementById('search_brand_input');

brands_list.forEach(item => {
    item.addEventListener('click', function() {
        handleClick(item);
    });
});

// Handle click on select list item.
function handleClick(item) {

    // brand_id.dispatchEvent(new Event('input'));
    // console.log(@this.brand_id);
    // Livewire.dispatch('brandSelected', [item.id.slice(6)]);

    // Cut 'brand-' from string and push Id value.
    @this.brand_id = item.id.slice(6);
    brand_id.value = item.id.slice(6);

    // Get brand name and set in search input value.
    search_brand_input.value = item.textContent.trim();
}
