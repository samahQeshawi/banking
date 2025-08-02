<div class="modal fade" id="transferModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center">
                        <h4 class="mb-2">التحويل</h4>
                        <p class="mb-5">
                           رصيدك الحالي 
                        <span class="text-success d-inline-flex align-items-center">{{ $balance }}
                        <svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" viewBox="0 0 1500 1500" width="16" height="16" class="ms-1">
                          <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#231f20"/>
                        </svg>
                        </span>
                        </p>

                      </div>
                      <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none">
                        <div class="bs-stepper-header border-0 p-1">
                          <div class="step" data-target="#details">
                            <button type="button" class="step-trigger">
                              <span class="bs-stepper-circle"><i class="ti ti-file-text"></i></span>
                              <span class="bs-stepper-label">
                                <span class="bs-stepper-title text-uppercase">البيانات</span>
                                <span class="bs-stepper-subtitle">ادخل البيانات </span>
                              </span>
                            </button>
                          </div>
                          
                         
                         
                          <div class="line"></div>
                          <div class="step" data-target="#submit">
                            <button type="button" class="step-trigger">
                              <span class="bs-stepper-circle"><i class="ti ti-check"></i></span>
                              <span class="bs-stepper-label">
                                <span class="bs-stepper-title text-uppercase">ارسال</span>
                                <span class="bs-stepper-subtitle">تأكيد الارسال</span>
                              </span>
                            </button>
                          </div>
                        </div>
                        <div class="bs-stepper-content p-1">
                         <form action="{{ route('admin.transfer') }}" method="POST">
                           @csrf
                            <!-- Details -->
                            <div id="details" class="content pt-4 pt-lg-0">
                              
                                <div class="mb-6">
                                    <div class="form-group">   
                                        <label for="phone" class="form-label"> رقم هاتف المستفيد</label>

                            <div class="input-group">
                                <input type="number" maxlength="11" name="phone"
                                    value="{{old('phone')}}" dir="ltr" id="phone"
                                    class="form-control border-input" required> 
                                <span class="input-group-text" id="basic-addon11">966+</span>                                      
                            </div>
                            <small class="form-text text-muted">يجب أن يكون رقم الجوال مسجلًا في البنك</small>      

                           </div>
                            @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                                </div> 

                                <div class="mb-6">
                                    <label for="amount" class="form-label">مبلغ التحويل</label>
                                    <input type="number" value="{{old('amount')}}" class="form-control" id="amount" name="amount" placeholder="المبلغ المحول" required/>
                                </div>

                                <div class="mb-6">
                                <label class="form-label" for="reason">الغرض من التحويل</label>
                                <select class="select2 form-select" name="reason" id="reason">
                                  <option value="" disabled selected>-اختر-</option>
                                  <option value="1" {{ old('reason') == 1 ? 'selected' : '' }}>مساعدات عائلية</option>
                                  <option value="2" {{ old('reason') == 2 ? 'selected' : '' }}>اقساط تأمين</option>
                                  <option value="3" {{ old('reason') == 3 ? 'selected' : '' }}>تسديد فواتير</option>
                                  <option value="4" {{ old('reason') == 4 ? 'selected' : '' }}>تمويل بناء عقار</option>
                                  <option value="5" {{ old('reason') == 5 ? 'selected' : '' }}>اخرى</option>
                                </select>
                            @error('reason')
                              <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="notes" class="form-label">ملاحظات التحويل</label>
                                    <textarea rows="2" class="form-control" id="notes" name="notes" placeholder="ملاحظات التحويل"></textarea>
                                </div>
                              
                              <div class="col-12 d-flex justify-content-between mt-6">
                                <button class="btn btn-label-secondary btn-prev" disabled>
                                  <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                  <span class="align-middle d-sm-inline-block d-none">السابق</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                  <span class="align-middle d-sm-inline-block d-none me-sm-2">التالي</span>
                                  <i class="ti ti-arrow-right ti-xs"></i>
                                </button>
                              </div>
                            </div>

                            <!-- submit -->
                            <div id="submit" class="content text-center pt-4 pt-lg-0">
                              <h5 class="mb-1">تأكيد التحويل</h5>

                              <div class="d-flex justify-content-between align-items-center border-bottom py-4 mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                  <h6 class="m-0">المبلغ المحول</h6>
                                </div>
                                <p class="m-0 d-none d-sm-block" id="getAmount"></p>
                              </div>

                              <div class="d-flex justify-content-between align-items-center border-bottom py-4 mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                  <h6 class="m-0">من</h6>
                                </div>
                                <p class="m-0 d-none d-sm-block" id="getFromAccount">{{ auth()->user()->name }}</p>
                              </div>

                              <div class="d-flex justify-content-between align-items-center border-bottom py-4 mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                  <h6 class="m-0">الى</h6>
                                </div>
                                <p class="m-0 d-none d-sm-block" id="getToAccount"></p>
                              </div>
                              
               

                              <div class="d-flex justify-content-between align-items-center border-bottom py-4 mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                  <h6 class="m-0">الغرض</h6>
                                </div>
                                <p class="m-0 d-none d-sm-block" id="getReason"></p>
                              </div>

                           
                              
                              <div class="col-12 d-flex justify-content-between mt-6">
                                <button class="btn btn-label-secondary btn-prev">
                                  <i class="ti ti-arrow-left ti-xs me-sm-2 me-0"></i>
                                  <span class="align-middle d-sm-inline-block d-none">السابق</span>
                                </button>
                                <button
                                  class="btn btn-success btn-next"
                                   type="submit"
                                  aria-label="Close">
                                  <span class="align-middle">تأكيد</span>
                                </button>
                                
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>