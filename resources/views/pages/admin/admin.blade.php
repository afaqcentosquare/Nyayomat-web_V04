<ul class="nav nav-tabs nav-justified mb-4" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            Customer
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
            Merchants
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form>
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-id-card"></i>
                                </span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="Business Name" type="text">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-phone"></i>
                                </span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="Phone No." type="text">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-at"></i>
                                </span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="E Mail" type="text">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-map"></i>
                                </span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="county" type="text">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-map-alt"></i>
                                </span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="Location" type="text">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <div class="input-group input-group-alternative mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-user-plus"></i>
                                </span>
                            </div>
                            <input class="form-control form-control-alternative" placeholder="User Email" type="text">
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center">
                    <div class="form-group">
                        <a href="{{route('vendor')}}" class="btn btn-md btn-outline-primary">
                            Submit
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row register-form">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="First Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Last Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email *" value="" />
                </div>
                <div class="form-group">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                +254
                            </span>
                        </div>
                        <input class="form-control" placeholder="Enter Phone Number" maxlength="9" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password *" value="" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password *" value="" />
                </div>
                <div class="form-group">
                    <select class="form-control">
                        <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                        <option>What is your Birthdate?</option>
                        <option>What is Your old Phone Number</option>
                        <option>What is your Pet Name?</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="`Answer *" value="" />
                </div>
                <button class="btn btn-success">
                    Register
                </button>
            </div>
        </div>
    </div>
</div>