@extends('../layouts.main')
@section('contents')

<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Plan</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('plans.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form id="planForm" action="{{ route('plans.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Plan Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Plan Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Plan Name"
                                    required>
                            </div>
                        </div>
                        <!-- Plan Description -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description">Plan Description</label>
                                <textarea name="description" id="description" class="form-control"
                                    placeholder="Plan Description" rows="4"></textarea>
                            </div>
                        </div>
                        <!-- Plan Price -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price">Price ($)</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Plan Price"
                                    step="0.01" min="0" required>
                            </div>
                        </div>
                        <!-- Plan Features -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="features">Features</label>
                                <textarea name="features" id="features" class="form-control" placeholder="Plan Features"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create Plan</button>
                <a href="{{ route('plans.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>

@endsection
