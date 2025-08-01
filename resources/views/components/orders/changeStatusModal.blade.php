<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">تغيير حالة الطلب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <form id="changeStatusForm">
                    <input type="hidden" id="orderId">
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label">اختر الحالة</label>
                        <select class="form-select" id="statusSelect" required>
                            <option value="pending">قيد الانتظار</option>
                            <option value="preparing">قيد التحضير</option>
                            <option value="ready">جاهز</option>
                            <option value="completed">مكتمل</option>
                            <option value="canceled">ملغي</option>
                        </select>
                    </div>
                    <div class="mb-3 d-none" id="cancelReasonContainer">
                        <label for="cancelReason" class="form-label">سبب الإلغاء</label>
                        <textarea class="form-control" id="cancelReason" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary" id="saveStatusBtn">حفظ</button>
            </div>
        </div>
    </div>
</div>
