{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}


<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "name", 'name' => "NAME", 'required' => true])
    {{ Form::text('name', $addemployee->name, ['id' => 'name', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "name"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "email", 'name' => "EMAIL", 'required' => true])
    {{ Form::text('email', $addemployee->email, ['id' => 'email', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "email"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "password", 'name' => "LOGIN PASSWORD", 'required' => true])
    {{ Form::text('password', '', ['id' => 'password', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "password"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "password_confirmation", 'name' => "CONFIRM PASSWORD", 'required'
    => true])
    {{ Form::text('password_confirmation', '', ['id' => 'password_confirmation', 'class' => 'form-control']) }}
    @include('helper.formerror', ['error' => "password_confirmation"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "role_id", 'name' => "ROLE", 'required' => true])
    <select name="role" id="role_id" class="form-select" readonly>
        @foreach ($role as $key => $value)
            <option value={{ $key }} {{ $addemployee->role == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "is_accountactive", 'name' => "USER STATUS", 'required' => false])
    {{ Form::select('is_accountactive', ['INACTIVE', 'ACTIVE'], $addemployee->is_accountactive, ['class' => 'form-select']) }}
    @include('helper.formerror', ['error' => "is_accountactive"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "avatar", 'name' => "PROFILE AVATAR", 'required' => false])
    <input type="file" name="avatar" accept="image/*" id="avatar" class="form-control">
    @include('helper.formerror', ['error' => "avatar"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "address", 'name' => "ADDRESS", 'required' => false])
    {{ Form::textarea('address', $addemployee->address, ['id' => 'address', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "address"])
</div>

<div class="col-md-4">
    @include('helper.formlabel', ['id'=>'', 'for' => "remarks", 'name' => "REMARK", 'required' => false])
    {{ Form::textarea('remarks', $addemployee->remarks, ['id' => 'remarks', 'class' => 'form-control', 'rows' => '2']) }}
    @include('helper.formerror', ['error' => "remarks"])
</div>
