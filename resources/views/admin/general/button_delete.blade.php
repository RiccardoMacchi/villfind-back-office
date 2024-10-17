<form action="{!! $link !!}" method="POST">
    @csrf

    @method('DELETE')

    <button type="submit" class="btn btn-sm btn-danger">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
