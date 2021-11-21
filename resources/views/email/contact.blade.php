<div style="text-align:right">
    لقد تلقيت رسالة من : {{ $request->get('name') }}
    <p>
    الاسم: {{ $request->get('name') }}
    </p>
   
    <p>
    البريد الالكتروني: {{ $request->get('email') }}
    </p>
    <p>
    رقم الجوال: {{ $request->get('mobile') }}
    </p>
    <p>
    الرسالة : {{ $request->get('details') }}
    </p>
</div>