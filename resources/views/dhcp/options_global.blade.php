@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="option_list">
        <h3>Global DHCP Options</h3>
        <p>
            <em>Note:</em> To remove an option just empty out all three boxes.
        </p>
        <hr />
        <form method="POST" action="{!! action('DhcpController@updateGlobalOptions') !!}">
            {!! csrf_field() !!}
            <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
            <div class="row" v-for="option in options">
                <input type="hidden" name="ids[@{{ $index }}]" value="@{{ option.id }}">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Option?</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" @click="addOption" title="Add another">+</button>
                            </span>
                            <input type="text" id="inputName[]" name="optionals[@{{ $index }}]" value="@{{ option.optional }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputName[]">Name</label>
                        <input type="text" id="inputName[]" name="names[@{{ $index }}]" value="@{{ option.name }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputName[]">Value</label>
                        <input type="text" id="inputName[]" name="values[@{{ $index }}]" value="@{{ option.value }}" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
<script>
    new Vue({
        el: '#option_list',
        data: {
            options: {!! $options !!}
        },
        methods: {
            addOption: function () {
                this.options.push({ id: null, optional: "option", name: "", value: "" });
            }
        },
        ready: function () {
            if (this.options.length == 0) {
                this.options.push({ id: null, optional: "option", name: "", value: "" });
            }
        }
    });
</script>
@endsection