@if($routeEdit)
<a style="margin-bottom: 3px" href="{{route($routeEdit,$id)}}" type="button"
        class="btn btn-icon btn-label-info waves-effect mr-2"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        data-bs-custom-class="tooltip-primary"
        title="تعديل ">
         <i class="fa-duotone fa-solid fa-pen-to-square"></i>
</a>
@endif
@if($routeDelete)
<button style="margin-bottom: 3px" type="button"
        class="btn btn-icon btn-label-danger waves-effect delete-btn"
                      data-bs-toggle="tooltip"
                      data-bs-placement="top"
                      data-bs-custom-class="tooltip-warning"
                      title="حذف "
                      data-table-id ="{{ $table }}"
                      data-url="{{ route($routeDelete, $id) }}" >
                     <i class="fa-duotone fa-solid fa-rectangle-xmark"></i>

</button>
@endif
@if($routeShow)
    <a style="margin-bottom: 3px" href="{{ route($routeShow, $id) }}" type="button"
       class="btn btn-icon btn-label-primary waves-effect mr-2"
       data-bs-toggle="tooltip"
       data-bs-placement="top"
       data-bs-custom-class="tooltip-info"
       title="عرض التفاصيل">
        <i class="fa-duotone fa-solid fa-eye"></i>
    </a>
@endif





