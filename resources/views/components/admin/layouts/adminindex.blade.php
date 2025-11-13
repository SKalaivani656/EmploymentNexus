<div class="card shadow-sm">
    <div class="card-header text-white indigo_darken_4">
        <div class="d-flex flex-row bd-highlight">
            <div class="flex-grow-1 bd-highlight"><span class="h4">{{ $title }}</span></div>
            <div class="bd-highlight">
                {{ $action }}
            </div>
          </div>
      </div>
    <div class="card-body">
       <div class="table-responsive">
          <table id="{{ $tableid }}" class="table table-hover w-100">
             <thead class="text-white indigo_darken_4">
                <tr>
                    {{ $tableheader }}
                </tr>
             </thead>
          </table>
       </div>
    </div>
 </div>
