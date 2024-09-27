@extends('backend.admin.layouts.master')
@section('content')
     <!-- Main Content -->

        <section class="section">
          <div class="section-header">
            <h1>Subscribers</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Send Email</h4>
                  </div>
                   <div class="card-body">
                    <form action="{{route('admin.subscribers.send-mail')}}" method="post">
                      @csrf
                      <div class="form-group">
                        <label for="">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Enter Subject">
                      </div>
                      <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="Enter Message"></textarea>
                      </div>
                      <button class="btn btn-primary">Send</button>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Subscriber</h4>
                  </div>
                   <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>
                </div>
              </div>
          </div>
          </div>
        </section>



@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
