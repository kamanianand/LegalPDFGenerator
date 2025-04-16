<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Email Thread PDF</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
        }
        .email { 
            margin-bottom: 30px; 
            page-break-inside: avoid; 
        }
        .header { 
            background-color: #f5f5f5; 
            padding: 10px; 
            border-radius: 5px; 
        }
        .from { 
            font-weight: bold; 
            color: #1a73e8; 
        }
        .to { 
            color: #5f6368; 
        }
        .subject { 
            font-size: 18px; 
            margin: 10px 0; 
        }
        .date { 
            color: #5f6368; 
            font-size: 12px; 
        }
        .body { 
            margin-top: 15px; 
            white-space: pre-wrap; 
        }
    </style>
</head>
<body>
    <h1>Email Thread PDF</h1>
    @if(count($emails) > 0)
        @foreach($emails as $email)
            <div class="email">
                <div class="header">
                    <div class="from">From: {{ $email['from'] }}</div>
                    <div class="to">To: {{ $email['to'] }}</div>
                    <div class="subject">{{ $email['subject'] }}</div>
                    <div class="date">{{ $email['date'] }}</div>
                </div>
                <div class="body">{{ $email['body'] }}</div>
            </div>
        @endforeach
    @endif
</body>
</html>