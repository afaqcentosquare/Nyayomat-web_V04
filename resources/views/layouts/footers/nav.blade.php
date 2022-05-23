<div class="row pt-1 align-items-center bg-white text-primary justify-content-xl-between">
    <div class="col-5 text-right">
        <div class="copyright text-center text-xl-left text-muted">
            
            <a href="" class="font-weight-bolder text-primary ml-1">
                {{config('app.name')}}
            </a> 
        </div>
    </div>
    <div class="col-7 text-right">
        <a href="tel:{{config('app.phone')}}" class="mr-1 text-primary ">
            <i class="bx bx-phone"></i>
        </a>

        <a href="mailto:{{config('app.email')}}" class="mr-1 text-primary ">
            <i class="bx bx-paper-plane"></i>
        </a>

        <a href="https://instagram.com/{{config('app.instagram')}}" class="mr-1  text-primary">
            <i class="bx bxl-instagram"></i>
        </a>

        <a href="https://twitter.com/{{config('app.twitter')}}" class="mr-1 text-primary ">
            <i class="bx bxl-twitter"></i>
        </a>

        <a href="https://wa.me/{{config('app.whatsapp')}}" class="mr-1 text-primary ">
            <i class="bx bxl-whatsapp"></i>
        </a>
    </div>
</div>