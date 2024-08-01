<x-app-web-layout>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 style="font-size: 1.5rem; font-weight: bold;"> Create Permission</h4>
                    <a href="{{url ('permissions')}}" class="btn btn-danger float-end">Back</a>

                </div>
                <div class="card-body">
                    <form action="{{url ('permissions')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="">Permission Name</label>
                            <input type="text" name="name" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


</x-app-web-layout>