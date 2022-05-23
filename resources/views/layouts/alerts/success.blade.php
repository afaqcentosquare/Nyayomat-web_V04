@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-inner--icon"><i class='bx bx-check-double'></i></span>
        <span class="alert-inner--text"><strong> Done ! </strong> {!! session()->get('success') !!} </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif