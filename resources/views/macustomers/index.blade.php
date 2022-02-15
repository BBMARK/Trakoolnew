@extends('layouts.backend')
@section('content')
{{-- สร้างคอนเทนเนอร์ให้แสดงข้อมูล --}}
<div class="contrainer-fluid">
    {{-- สร้างคลาส card ทำหน้าที่ เป็นพื้นหลังในการแสดงข้อมูล --}}
    <div class="card">
        {{-- การ์ดบอดี้ จะเป็นส่วนที่จะแสดงข้อมูลของคลาส การ์ด --}}
        <div class="card-body">
            {{-- แบ่งบรรทัด สร้างแถวขึ้นมาใหม่ --}}
            <div class="row">
                {{-- เริ่มการใช้งาน grid --}}
                <div class="col-12">
                    <h3>ข้อมูลMA</h3>

                    
                    <div class="row">
                        <div class="col-12" align="right">
                            <button class="btn btn-success" onclick="createCus()">เพิ่มสินค้า </button> &nbsp; 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered table-inverse table-border-style table-striped text-center" id="dtTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">ชื่อลูกค้า</th>
                                            <th class="text-center">ชื่อร้านค้า</th>
                                            <th class="text-center">ชื่อสินค้า</th>
                                            <th class="text-center">วันที่เริ่มสินค้า</th>
                                            <th class="text-center">วันที่หมดอายุสินค้า</th>
                                            <th class="text-center">cloud</th>
                                            <th class="text-center">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<div class="modal" id="addCustomer" tabindex="-1">
    <form action="" method="post" id="shared-form" enctype='multipart/form-data'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดสินค้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <input class="form-control" type="hidden" id="id" name="id">
                    <input class="form-control" type="hidden" name="emp_id" id="emp_id"value="{{ Auth::user()->id }}">
                    
                    
                    

                    <div class="form-group">
                            <label for="exampleFormControlSelect1">ชื่อ-นามสกุล ลูกค้า</label>
                            <select name="cus_id" class="form-control selectpicker"  data-live-search="true" id="cus_id">
                                @foreach ($item_cus as $item)
                                    <option> {{ $item->full_name }}</option>
                                @endforeach


                            </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">ชื่อร้านค้า</label>
                        <select name="store_name_id" class="form-control selectpicker" data-live-search="true" id="store_name_id">
                            @foreach ($item_cus as $item)
                                <option> {{ $item->store_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">ชื่อสินค้า</label>
                        <select name="produet_id" class="form-control selectpicker" data-live-search="true" id="produet_id">
                            @foreach ($product_user as $item)
                                <option> {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    {{--<div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-5">
                            <div class="mb-3">
                                <label  class="form-label">วันที่เริ่ม</label>
                                <input class="form-control" width="200" name="newdate_ma" type="date"  required />
        
                            </div>
                        </div>
                </div>  --}}


                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-5">
                            <div class="mb-3">
                                <label  class="form-label">วันที่หมด</label>
                                <input class="form-control" width="200" name="outdate_ma" type="date"  required />
        
                            </div>
                        </div>
                </div>

                                 


                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Cloud</label>
                            <input class="form-control" type="text" id="cloud" name="cloud">
                        </div>
                    
                    


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
</div>





@endsection
@section('script')
<script>
    var route_index = "{{ route('macustomers.index') }}"
    var route_store = "{{ route('macustomers.store') }}"
    $(function() {
        table = $('#dtTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: route_index,
                global: false,
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                },
                {
                    data: 'cus_id',
                    name: 'cus_id'
                },
                {
                    data: 'store_name_id',
                    name: 'store_name_id'
                },
                {  
                    data: 'produet_id',
                    name: 'produet_id'
                },
                {
                    data: 'newdate_ma',
                    name: 'newdate_ma'
                },
                {
                    data: 'outdate_ma',
                    name: 'outdate_ma'
                },
                {
                    data: 'cloud',
                    name: 'cloud'
                },
                {
                    data: 'edit',
                    name: 'edit',
                    orderable: false,
                    searchable: false
                },

            ],
        })

        $("#shared-form").on('submit', function(e) {
            e.preventDefault()
            formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: route_store,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        table.ajax.reload();
                        $('#addCustomer').modal('hide')
                        show_success();
                    } else {
                        show_warning(response.message);
                    }
                },
                error: function(err) {

                    show_error('error');
                    console.log(err.responseText);
                }
            });
        })

    })

    function createCus() {
        $('#addCustomer').modal('show')
    }
    

    function editMa(id) {
        $.ajax({
            type: "GET",
            url: "{{ url('manager/editMa') }}" + "/" + id,
            dataType: "json",
            success: function(response) {
                console.log(response)
                $('#id').val(response.cus.id)
                $('#cus_id').val(response.cus.cus_id)
                $('#produet_id').val(response.cus.produet_id)
                $('#outdate_ma').val(response.cus.outdate_ma)
                $('#store_name_id').val(response.cus.store_name_id)
                $('#cloud').val(response.cus.cloud)
                
                newdate_ma
                $('#addCustomer').modal('show')
            }
        });
    }

    function delMa(id) {
        $.ajax({
            type: "GET",
            url: "{{ url('manager/delMa') }}" + "/" + id,
            dataType: "json",
            success: function(response) {
                console.log(response)
                table.ajax.reload();
                show_success();
            }
        });
    }

    
</script>


@endsection