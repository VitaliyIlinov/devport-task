<form class="needs-validation" method="post" action="{{ $action }}">
    @csrf
    <div class="row g-3">
        <div class="col-sm-12">
            <x-forms.input name="name"/>
        </div>
        <div class="col-sm-12">
            <x-forms.input name="phone_number" type="number"/>
        </div>
        <button class="w-100 btn btn-primary btn-lg" type="submit">Register</button>
    </div>
</form>
