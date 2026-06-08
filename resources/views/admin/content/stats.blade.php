@extends('layouts.admin.app')

@section('title', 'Stats Bar - Royal Ark College Admin')

@section('content')
<div class="admin-content">
    <div class="page-header">
        <div class="page-header-left">
            <h1>Homepage Stats Bar</h1>
        </div>
        <div class="page-header-actions">
            <button class="btn btn-primary btn-sm">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="grid-2">
                <!-- Stat 1 -->
                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label">Stat 1 - Label</label>
                        <input type="text" class="form-control" value="Students">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" value="1200">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Suffix</label>
                            <input type="text" class="form-control" value="+">
                        </div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label">Stat 2 - Label</label>
                        <input type="text" class="form-control" value="Staff">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" value="80">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Suffix</label>
                            <input type="text" class="form-control" value="+">
                        </div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label">Stat 3 - Label</label>
                        <input type="text" class="form-control" value="Programs">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" value="12">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Suffix</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="form-section">
                    <div class="form-group">
                        <label class="form-label">Stat 4 - Label</label>
                        <input type="text" class="form-control" value="Years of Excellence">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Value</label>
                            <input type="number" class="form-control" value="19">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Suffix</label>
                            <input type="text" class="form-control" value="+">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection