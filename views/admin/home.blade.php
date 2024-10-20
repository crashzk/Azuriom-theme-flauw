
<fieldset class="d-flex flex-column gap-3 border p-2 w-100">
    <div class="form-check p-0">
        <div class="switcher">
            <small class="fw-bold fs-5">{{trans('theme::admin.show_servers')}}</small>
            <label for="home-servers">
                <input type="checkbox" id="home-servers" name="home[servers][on]" @if(config('theme.home.servers.on')) checked @endif @error('theme.home.servers.on') is-invalid @enderror/>
                <span><small></small></span>
            </label>
        </div>
        @error('home-servers')
        <small class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></small>
        @enderror
    </div>
</fieldset>
