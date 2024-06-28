<a class="btn btn-primary btn-circle" href="{!! route('transactions.edit', $model->id) !!}">
    <i class="fas fa-pencil-alt"></i>
</a>
<button class="btn btn-danger btn-circle" id="remove-btn" type="button" data-id="{!! $model->id !!}">
    <i class="fas fa-trash"></i>
</button>