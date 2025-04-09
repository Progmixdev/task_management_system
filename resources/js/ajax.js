import $ from "jquery";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $("form.toggle-status-form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var taskId = form.data("task-id");
        var url = form.attr("action");

        $.ajax({
            url: url,
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                var taskStatus =
                    response.status == "done" ? "✓ Done" : "⏳ Pending";
                var statusClass =
                    response.status == "done"
                        ? "text-green-600"
                        : "text-yellow-500";

                form.find(".status-text")
                    .text(taskStatus)
                    .removeClass("text-green-600 text-yellow-500")
                    .addClass(statusClass);
            },
        });
    });

    $(".open-popup-link").magnificPopup({
        type: "inline",
        midClick: true,
    });

    $(".open-popup-link").on("click", function (e) {
        e.preventDefault();
        var popupContent = $("#popup-content");
        popupContent.html('<div class="loading">Loading...</div>');

        var projectId = $(this).data("project-id");

        $.ajax({
            url: "/tasks/" + projectId + "/create",
            type: "GET",
            success: function (response) {
                popupContent.html(response);
            },
            error: function () {
                popupContent.html(
                    '<div class="error">Error loading form.</div>'
                );
            },
        });
    });

    $("#task-form").on("submit", function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: form.attr("action"), // نحدد المسار الصحيح
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json", // تأكدنا من نوع البيانات المرجعية
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function (response) {
                // إغلاق نافذة الماجنيفيك
                $.magnificPopup.close();

                // إذا تمت العملية بنجاح
                if (response.success) {
                    alert(response.message); // عرض الرسالة

                    // إضافة المهمة إلى قائمة المهام مباشرة في الصفحة
                    var taskHtml = `<li class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                                        <strong class="text-lg text-gray-900 dark:text-white">${response.task.title}</strong>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">${response.task.description}</p>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Due: ${response.task.due_date}</span>
                                    </li>`;

                    $("#task-list").append(taskHtml);
                }
            },
            error: function (xhr, status, error) {
                alert("Error: " + xhr.responseText);
            }
        });
    });


});
