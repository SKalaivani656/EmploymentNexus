<div class="col-md-12">
    <div id="notificationlink">
       <div class="table-responsive">
          <table class="table table-striped table-hover">
             <thead>
                <tr class="table-primary">
                   <th>NAME</th>
                   <th>SOURCE</th>
                   <th>LINK</th>
                   <th>DELETE</th>
                </tr>
             </thead>
             <tbody>

               @foreach ($notifcation as $index => $eachnotifcation)
               <tr>
                  <td>
                     <input wire:model="notifcation.{{$index}}.notification_name" wire:change="notificationlivevalidation"  wire:keyup="notificationlivevalidation"  name = "notification_name[]" type="text" class="form-control" >
                     @error('notifcation.'.$index.'.notification_name') <span class="text-danger error">{{ $message }}</span> @enderror
                  </td>
                  <td>
                     <input wire:model="notifcation.{{$index}}.notification_source"  name = "notification_source[]" wire:change="notificationlivevalidation"  wire:keyup="notificationlivevalidation" type="text" class="form-control" >
                      @error('notifcation.'.$index.'.notification_source') <span class="text-danger error">{{ $message }}</span> @enderror
                  </td>
                  <td>
                     <input wire:model="notifcation.{{$index}}.notification_link"  name = "notification_link[]" wire:change="notificationlivevalidation"  wire:keyup="notificationlivevalidation" type="text" class="form-control" >
                      @error('notifcation.'.$index.'.notification_link') <span class="text-danger error">{{ $message }}</span> @enderror
                  </td>
                  <td><a wire:click.prevent="removenotification({{$index}})" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></a></td>
               </tr>
               @endforeach
             </tbody>
             <tfoot>
                <tr style="">
                   <td class="table-empty">
                      <a wire:click.prevent="addnotification" class="table-add_line btn btn-success">Add Line</a>
                   </td>
                </tr>
             </tfoot>
          </table>
       </div>
    </div>
 </div>