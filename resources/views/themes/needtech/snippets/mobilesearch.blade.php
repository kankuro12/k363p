<div class="mobile-search" id="mobile-search-holder">
    <div class="search-top shadow">
        <div class="input-holder">
            <span class="back close-mobile-search">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="input-min-holder">

                <input data-url="{{route('n.mobile.search')}}" type="text" id="mob-search-input" class="input" placeholder="Search Location Or Establishments">
                <span class="close d-none" id="clear-mobile-search">
                    <i class="fas fa-times"></i>
                </span>
            </span>
            <span class="gosearch">
                Search
            </span>
        </div>
    </div>

    <div class="search-result" id="mob-search-result">
        <span class="spinner d-none" id="mobile-search-spinner">

        </span>
    </div>
</div>
