              @foreach($modules as $eachmodule)
              <div class="form-group">
                  <label class="col-sm-2 control-label">
                      <b>{{$eachmodule->module_name}}</b>
                  </label>
                  <div class="col-sm-10">
                      <div class="checkbox" style="margin-bottom: 5px;">
                          <label>
                              <input type="checkbox" name="access_management[{{$eachmodule->id}}]['view']" <?php if (isset($access[$eachmodule->id])) {
                                                                                                                if ($access[$eachmodule->id][0]['can_view'] == '1') {
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                            } ?>>
                              Can View/Search
                          </label>
                      </div>
                      <div class="checkbox" style="margin-bottom: 5px;">
                          <label style="display: block;">
                              <input type="checkbox" name="access_management[{{$eachmodule->id}}]['add']" <?php if (isset($access[$eachmodule->id])) {
                                                                                                                if ($access[$eachmodule->id][0]['can_add'] == '1') {
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                            } ?>>
                              Can Add
                          </label>
                      </div>
                      <div class="checkbox" style="margin-bottom: 5px;">
                          <label style="display: block;">
                              <input type="checkbox" name="access_management[{{$eachmodule->id}}]['edit']" <?php if (isset($access[$eachmodule->id])) {
                                                                                                                if ($access[$eachmodule->id][0]['can_edit'] == '1') {
                                                                                                                    echo "checked";
                                                                                                                }
                                                                                                            } ?>>
                              Can Edit
                          </label>
                      </div>
                      <div class="checkbox" style="margin-bottom: 5px;">
                          <label style="display: block;">
                              <input type="checkbox" name="access_management[{{$eachmodule->id}}]['delete']" <?php if (isset($access[$eachmodule->id])) {
                                                                                                                    if ($access[$eachmodule->id][0]['can_delete'] == '1') {
                                                                                                                        echo "checked";
                                                                                                                    }
                                                                                                                } ?>>
                              Can Remove
                          </label>
                      </div>
                  </div>
              </div>
              @endforeach