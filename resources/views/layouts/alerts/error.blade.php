@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-inner--icon"><i class='bx bx-x'></i></span>
        <span class="alert-inner--text"><strong> Something went wrong ! </strong> {!! session()->get('error') !!} </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif