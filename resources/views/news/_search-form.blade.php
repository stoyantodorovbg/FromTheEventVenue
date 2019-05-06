<div class="card mb-3">
    <div class="card-header">
        <h2 class="text-center">SEARCH NEWS</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('news.search') }}"
              method="POST">
            @csrf
            <search-news
                :categories="{{ $categories }}"
                :delete_criterias="{{ $delete_criterias }}"
            ></search-news>

            <button type="submit"
                class="btn btn-primary font-weight-bolder w-100">
                SEARCH
            </button>
        </form>
    </div>
</div>
