                @foreach($modules as $eachmodule)
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">{{$eachmodule->module_name}}</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['view']" <?php if(isset($access[$eachmodule->id])){ if($access[$eachmodule->id][0]['can_view']=='1' ){ echo "checked"; }} ?>> Can View/Search &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['add']" <?php if(isset($access[$eachmodule->id])){ if($access[$eachmodule->id][0]['can_add']=='1' ){ echo "checked"; }} ?>> Can Add &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['edit']" <?php if(isset($access[$eachmodule->id])){ if($access[$eachmodule->id][0]['can_edit']=='1' ){ echo "checked"; }} ?>> Can Edit &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  name="access_management[{{$eachmodule->id}}]['delete']" <?php if(isset($access[$eachmodule->id])){ if($access[$eachmodule->id][0]['can_delete']=='1' ){ echo "checked"; }} ?>> Can Remove &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>

                    </div>
             @endforeach
