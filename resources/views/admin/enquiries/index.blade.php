@extends('layouts.admin.app')

@section('title', 'Enquiries - Royal Ark College Admin')

@section('content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h1>Enquiries & Messages</h1>
            <p>5 unread messages from parents and visitors</p>
        </div>
    </div>

    <!-- Enquiry Shell -->
    <div class="enquiry-shell">
        <!-- List Pane -->
        <div class="enquiry-list-pane">
            <div class="enquiry-list-header">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="font-family: var(--font-ui); font-weight: 700; color: var(--ink);">Messages</div>
                    <select class="form-control" style="width: auto; padding: 6px 10px; font-size: var(--t-xs);">
                        <option>All</option>
                        <option>Unread</option>
                        <option>Archived</option>
                    </select>
                </div>
                <div class="enquiry-list-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search messages…">
                </div>
            </div>
            <div class="enquiry-list">
                <div class="enquiry-list-item unread active">
                    <div class="enquiry-sender">Mrs. Fatima Bello</div>
                    <div class="enquiry-preview">Admission enquiry for my daughter, Zainab Bello - Primary 3...</div>
                    <div class="enquiry-time">5 min ago</div>
                </div>
                <div class="enquiry-list-item unread">
                    <div class="enquiry-sender">Mr. Chukwuma Eze</div>
                    <div class="enquiry-preview">Fee structure for the new academic session. Can you send the breakdown...</div>
                    <div class="enquiry-time">1 hr ago</div>
                </div>
                <div class="enquiry-list-item unread">
                    <div class="enquiry-sender">Anonymous</div>
                    <div class="enquiry-preview">I would like to schedule a tour of the school...</div>
                    <div class="enquiry-time">Yesterday</div>
                </div>
                <div class="enquiry-list-item">
                    <div class="enquiry-sender">Mrs. Adebayo</div>
                    <div class="enquiry-preview">Thank you for the quick response. We'll see you on Saturday...</div>
                    <div class="enquiry-time">2 days ago</div>
                </div>
            </div>
        </div>

        <!-- Detail Pane -->
        <div class="enquiry-detail-pane">
            <div class="enquiry-detail-header">
                <div style="display: flex; align-items: flex-start; justify-content: space-between;">
                    <div>
                        <div class="enquiry-detail-from">Mrs. Fatima Bello</div>
                        <div class="enquiry-detail-meta">fatima.bello@gmail.com · +234 803 123 4567</div>
                        <div class="enquiry-detail-subject">Admission for my daughter - Primary 3</div>
                    </div>
                    <div style="display: flex; gap: 6px;">
                        <button class="btn btn-icon btn-outline" title="Mark as unread"><i class="fas fa-circle"></i></button>
                        <button class="btn btn-icon btn-outline" title="Archive"><i class="fas fa-archive"></i></button>
                        <button class="btn btn-icon btn-outline" title="Flag"><i class="fas fa-flag"></i></button>
                        <button class="btn btn-icon btn-outline" title="Delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <div class="enquiry-detail-body">
                <div class="enquiry-message-text">Good morning,

I hope this message meets you well. I would like to make enquiries about the admission process into Primary 3 for my daughter, Zainab Bello.

She is currently 8 years old and in Primary 2 at another school. We would like to know:
1. The admission requirements
2. The tuition fees for Primary 3
3. If there will be an entrance examination

Thank you for your time and I look forward to your response.

Best regards,
Fatima Bello</div>
            </div>
            <div class="enquiry-reply-area">
                <textarea class="enquiry-reply-input" placeholder="Type your reply..."></textarea>
                <div class="enquiry-reply-actions">
                    <div style="display: flex; gap: 8px;">
                        <button class="btn btn-ghost btn-sm"><i class="fas fa-paperclip"></i> Attach</button>
                    </div>
                    <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Send Reply</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection