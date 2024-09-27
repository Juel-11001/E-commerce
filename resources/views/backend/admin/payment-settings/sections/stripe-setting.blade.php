<div class="tab-pane fade show" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <form action="{{route('admin.stripe-setting.update', 1)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
        <div class="form-group col-md-6">
            <label for="inputState">Stripe Status</label>
            <select id="inputState" class="form-control" name="status">
                <option value="">Select</option>
              <option {{$stripeSetting->status===1 ? 'selected' : ''}} value="1">Enable</option>
              <option {{$stripeSetting->status===0 ? 'selected' : ''}} value="0">Disable</option>
            </select>
          </div>
        <div class="form-group col-md-6">
            <label for="inputState">Account Mode</label>
            <select id="inputState" class="form-control" name="account_mode">
                <option value="">Select</option>
              <option {{$stripeSetting->account_mode===0 ? 'selected' : ''}} value="0">Sandbox</option>
              <option {{$stripeSetting->account_mode===1 ? 'selected' : ''}} value="1">Live</option>
            </select>
          </div>
        <div class="form-group col-md-6">
            <label for="inputState">Country Name</label>
            <select id="inputState" class="form-control select2" name="country_name">
                <option value="">Select</option>
                @foreach (config('settings.country_list') as $country)
                    <option {{$stripeSetting->country_name===$country ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                @endforeach

            </select>
          </div>
        <div class="form-group col-md-6" >
            <label for="inputState">Currency Name</label>
            <select id="inputState" class="form-control select2" name="currency_name">
                <option value="">Select</option>
                @foreach (config('settings.currency_list') as $key=>$currency)
                    <option {{$stripeSetting->currency_name===$currency ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                @endforeach

            </select>
          </div>
        <div class="form-group col-md-12">
            <label>Stripe Client Id</label>
            <input type="text" class="form-control" name="client_id" value="{{$stripeSetting->client_id}}">
        </div>
        <div class="form-group col-md-6">
            <label>Stripe Secret Key</label>
            <input type="text" class="form-control" name="secret_key" value="{{$stripeSetting->secret_key}}">
        </div>
        <div class="form-group col-md-6">
            <label>Currency Rate (Per {{$settings->currency_name}})</label>
            <input type="text" class="form-control" name="currency_rate" value="{{$stripeSetting->currency_rate}}">
        </div>
    </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
