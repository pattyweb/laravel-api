<!-- holiday_plans.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Plans PDF</title>
    <!-- Add any additional styles or meta tags here -->
</head>
<body>

@foreach($holidayPlans as $holidayPlan)
    <h1>Holiday Plan</h1>

    <table>
        <tr>
            <th>Title</th>
            <td>{{ $holidayPlan->title }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $holidayPlan->description }}</td>
        </tr>
        <tr>
            <th>Date</th>
            <td>{{ $holidayPlan->date }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>{{ $holidayPlan->location }}</td>
        </tr>
        <tr>
            <th>Participants</th>
            <td>
                @if(is_array($holidayPlan->participants))
                    {{ implode(', ', $holidayPlan->participants) }}
                @else
                    {{ $holidayPlan->participants }}
                @endif
            </td>
        </tr>
    </table>

    <!-- Add any additional content or styling here -->

@endforeach

</body>
</html>
