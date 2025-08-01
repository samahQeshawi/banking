 
                        <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                          
                            <form action="{{ $route }}" 
                                  method="post" enctype="multipart/form-data" class="modal-content">
                                @csrf
                              <div class="modal-header">
                                <h5 class="modal-title" id="backDropModalTitle">{{ $modalTitle }}</h5>
                                <button
                                  type="button"
                                  class="btn-close cancel-button"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                @if($cardImg)
                                @php
                                  $photoPath = session('photo_temp');
                                  $currentPhoto = $photoPath ? asset('storage/' . $photoPath) : asset('dashboard/assets/img/6.jpg');
                                @endphp
                                <div class="card-body d-flex justify-content-center align-items-center mb-2">

                                  <div class="d-flex align-items-start align-items-sm-center gap-6 position-relative">
                                  <!-- Image preview with click upload functionality -->
                                    <div class="position-relative"> 
            
                                    <img src="{{ $currentPhoto }}" alt="user-avatar"
                                         class="d-block w-px-100 h-px-100 rounded cursor-pointer uploaded-avatar"  
                                         data-default-src="{{ asset('dashboard/assets/img/6.jpg') }}"/>

                                    <!-- Reset Icon -->
                                    <button type="button" class="btn btn-sm btn-danger position-absolute 
                                    top-0 start-100 translate-middle p-1 rounded-circle d-flex 
                                    align-items-center justify-content-center reset-image" style="width: 24px; height: 24px;">
                                      <i class="ti ti-x"></i>
                                     </button>
                                    </div>

                                          <!-- Hidden file input -->
                                      <input type="file" class="account-file-input upload" name="image" hidden accept="image/png, image/jpeg" />

                                      @error('image')
                                         <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                </div>
                                @endif

                                <div class="row">
                                  <div class="col mb-4">
                                    <label for="title" class="form-label">الاسم</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required/>
                                     @error('title')
                                      <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                  </div>
                                  @if($sortOrder)
                                  <div class="col mb-4">
                                    <label for="sort_order" class="form-label">الترتيب بالمتجر</label>
                                    <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order') }}" required/>
                                     @error('sort_order')
                                      <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                  </div>
                                  @endif
                                </div>
 
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary cancel-button" data-bs-dismiss="modal">
                                  الغاء
                                </button>
                                <button type="submit" class="btn btn-success">اضافة</button>
                              </div>
                            </form>
                          </div>
                        </div>
