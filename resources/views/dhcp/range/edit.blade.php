@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="range_list">
        <h3>
            Ranges for subnet {{ $subnet->name }}
        </h3>
        <p>
            <em>Note:</em> To remove a range just empty out all the boxes.
        </p>
        <hr />
        <form method="POST" action="{!! action('DhcpRangeController@update', $subnet->id) !!}">
            {!! csrf_field() !!}
            <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
            <div class="row" v-for="range in ranges">
                <input type="hidden" name="ids[@{{ $index }}]" value="@{{ range.id }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Start</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" @click="addrange" title="Add another">+</button>
                            </span>
                            <input type="text" id="inputName[]" name="starts[@{{ $index }}]" value="@{{ range.start }}" class="form-control" placeholder="Eg, 192.168.1.34">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputName[]">End</label>
                        <input type="text" id="inputName[]" name="ends[@{{ $index }}]" value="@{{ range.end }}" class="form-control" placeholder="Eg, 192.168.1.47">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
<script>
    new Vue({
        el: '#range_list',
        data: {
            ranges: {!! $ranges !!}
        },
        methods: {
            addrange: function () {
                this.ranges.push({ id: null, start: "", end: "" });
            }
        },
        ready: function () {
            if (this.ranges.length == 0) {
                this.ranges.push({ id: null, start: "", end: "" });
            }
        }
    });
</script>
@endsection