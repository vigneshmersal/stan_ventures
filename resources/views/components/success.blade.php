@if (session('success'))
    <div class="alert alert-success custom-alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('success') }}
    </div>
@endif
