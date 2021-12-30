<div class="modal-dialog modal-dialog-scrollable modal-@yield('modal-size', 'default')">
    <form action="@yield('form-action')" method="@yield('form-method', 'POST')">
        <div class="modal-content">
            <div class="modal-header bg-@yield('modal-color', 'light')">
                <h5 class="modal-title text-@yield('text-color', 'light')">@yield('modal-title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @yield('modal-body')
            </div>
            <div class="modal-footer">
                @yield('modal-footer')
            </div>
        </div>
    </form>
</div>