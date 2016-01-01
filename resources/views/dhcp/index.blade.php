@extends('layouts.app')

@section('content')
<div class="container" id="dhcp_list">
    <div class="row">
        <div class="col-md-8">
            <a href="{!! action('DhcpController@create') !!}" class="btn btn-primary">Add New</a>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="{!! action('DhcpOptionController@edit') !!}">Global Options</a></li>
                <li><a href="{!! action('DhcpNetworkController@index') !!}">Subnet Groups</a></li>
                <li><a href="{!! action('DhcpSubnetController@index') !!}">Subnets</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Whatever</a></li>
              </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group pull">
                <input type="search" id="inputSearch" name="searchterm" value="@{{ searchterm }}" class="form-control pull-right" placeholder="Search - Eg, 192.168.1, 00:11:33" v-model="searchterm" @keyup="search | debounce 500">
            </div>
        </div>
    </div>
    <div class="row">
        <hr />
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
                        <td>
                            <span class="glyphicon glyphicon-ban-circle" v-if="entry.is_disabled"></span>
                            <a href="/dhcp/edit/@{{ entry.id }}">@{{ entry.mac }}</a>
                            <span class="glyphicon glyphicon-sd-video" v-if="entry.is_ssd"></span>
                        </td>
                        <td>@{{ entry.hostname }}</td>
                        <td>@{{ entry.ip }}</td>
                        <td><a href="mailto:@{{ entry.owner_email }}">@{{ entry.owner_email | strip_email }}</a></td>
                        <td><a href="mailto:@{{ entry.added_by }}">@{{ entry.added_by | strip_email }}</a></td>
                        <td>@{{ entry.updated_at }}</td>
                    </tr>
            </tbody>
        </table>
        <div class="col-md-6">
            <a href="#" class="btn btn-warning" @click="bulkEdit" v-if="searchterm">Bulk Edit</a>
        </div>
        <div class="col-md-6">
            <p class="pull-right help-block">@{{ entries.length }} results</p>
        </div>
    </div>
</div>
<script>
    Vue.filter('strip_email', function (value) {
      return value.replace(/\@.+$/, '');
    });
    new Vue({
        el: '#dhcp_list',
        data: {
            searchterm: "",
            entries: {!! $entries !!}
        },
        methods: {
            search: function () {
                if (this.searchterm) {
                    this.$http.get('/dhcp/search/' + encodeURIComponent(this.searchterm)).then(function (response) {
                        this.entries = response.data;
                    });
                } else {
                    this.entries = {!! $entries !!}
                }
            },
            bulkEdit: function() {
                window.location = "{!! action('DhcpController@bulkEdit') !!}/" + encodeURIComponent(this.searchterm);
            }
        }
    });
</script>
@endsection