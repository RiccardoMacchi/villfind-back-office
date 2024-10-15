<form class="d-inline" action="{{ $route }}" method="POST" onsubmit="return confirm('{{ $title }}')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
</form>
