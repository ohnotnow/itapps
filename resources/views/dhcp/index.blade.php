@extends('layouts.app')

@section('content')
<div class="container" id="dhcp_list">
    <div class="row">
        <div class="form-group">
            <label for="inputSearch">Search</label>
            <input type="text" id="inputSearch" name="searchterm" value="@{{ searchterm }}" class="form-control" placeholder="Eg, 192.168.1, 00:11:33" v-model="searchterm" @keyup="search | debounce 500">
        </div>
        <table class="table table-striped table-hover" id="dhcp_table">
            <thead>
                <tr>
                    <th>MAC</th>
                    <th>Hostname</th>
                    <th>IP</th>
                    <th>Owner</th>
                    <th>Added By</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                    <tr v-for="entry in entries">
                        <td><a href="/dhcp/edit/@{{ entry.id }}">@{{ entry.mac }}</a></td>
                        <td>@{{ entry.hostname }}</td>
                        <td>@{{ entry.ip }}</td>
                        <td><a href="mailto:@{{ entry.owner_email }}">@{{ entry.owner_email }}</a></td>
                        <td><a href="mailto:@{{ entry.added_by }}">@{{ entry.added_by }}</a></td>
                        <td>@{{ entry.updated_at }}</td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
    new Vue({
        el: '#dhcp_list',
        data: {
            searchterm: "",
            entries: {!! $entries !!}
        },
        methods: {
            search: function () {
                if (this.searchterm) {
                    this.$http.get('/dhcp/search/' + this.searchterm).then(function (response) {
                        this.entries = response.data;
                    });
                } else {
                    this.entries = {!! $entries !!}
                }
            }
        }
    });
</script>
@endsection