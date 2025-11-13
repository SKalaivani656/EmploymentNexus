<div class="col-md-2">
   {!! Form::checkbox('active',  null,  isset($websitemarquee) ? $websitemarquee->active : 0 ,array('id'=>'branchactive','class'=>'form-check-input')) !!}
   @include('helper.formlabel', ['id'=>'',  'for' => "branchactive", 'name' => "ACTIVE", 'required' => false])
   @include('helper.formerror', ['error' => "active"])
</div>

<div class="col-md-10">
@include('helper.formlabel', ['id'=>'',  'for' => "marqueetype", 'name' => "MARQUEE TYPE", 'required' => true])
 <select name="marqueetype" id="marqueetype" class="form-select"  readonly>
       @foreach(config('archive.marqueetype') as $key => $value)
         <option  value={{ $key }} {{ ($websitemarquee->marqueetype == $key) ? 'selected' : '' }} >
            {{ $value }}
         </option>
      @endforeach
   </select>
</div>

<div class="col-md-12">
   @include('helper.formlabel', ['id'=>'',  'for' => "marquee", 'name' => "MARQUEE", 'required' => true])
   {{ Form::textarea('marquee', $websitemarquee->marquee, array('id'=>'marquee', 'class'=>'form-control marquee')) }}
   @include('helper.formerror', ['error' => "marquee"])
</div>

<div class="col-md-12">
   @include('helper.formlabel', ['id'=>'',  'for' => "remarks", 'name' => "REMARK", 'required' => false])
   {{ Form::textarea('remarks',$websitemarquee->remarks ,array('id'=>'remarks','class'=>'form-control', 'rows'=>'2')) }}
   @include('helper.formerror', ['error' => "remarks"])
</div>
