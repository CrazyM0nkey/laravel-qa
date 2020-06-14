<div class="ml-auto">
    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
    <form action="{{ route('questions.destroy', $question->id) }}" style="display: inline;" class="form-delete"
        method="post">
        @method('DELETE')
        @csrf
        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>