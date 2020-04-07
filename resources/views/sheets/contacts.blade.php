<style>
    td {
        border: 1px solid #eee;
    }
</style>

<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Personal LinkedIn</th>
        <th>Position</th>
        <th>Company</th>
        <th>Location</th>
        <th>|</th>
        <th>Co Name (Crawled)</th>
        <th>Co Website (Crawled)</th>
        <th>Co Linkedin (Crawled)</th>
        <th>Co Twitter (Crawled)</th>
        <th>Co Facebook (Crawled)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $key => $contact)
        @php if (!$contact->fullcontact['linkedin']) { continue; } @endphp
        <tr>
            <td>{{ $contact->first_name }}</td>
            <td>{{ $contact->last_name }}</td>
            <td>{{ $contact->email }}</td>
            <td>
                <a href="{{ $contact->fullcontact['linkedin'] }}">{{ $contact->fullcontact['linkedin'] }}</a>
            </td>
            <td>
                {{ $contact->fullcontact['title'] }}
            </td>
            <td>
                {{ $contact->fullcontact['organization'] }}
            </td>
            <td>
                {{ $contact->fullcontact['details']['locations'][0]['formatted'] ?? null }}
            </td>
            <td>
                |
            </td>
            <td>
                {{
                    $contact->company->fullcontact['name'] ?? null
                }}
            </td>
            <td>
                <a href="{{ $contact->company->fullcontact['website'] ?? null }}" target="_blank">
                    {{ $contact->company->fullcontact['website'] ?? null }}
                </a>
            </td>
            <td>
                <a href="{{ $contact->company->fullcontact['linkedin'] ?? null }}" target="_blank">
                    {{ $contact->company->fullcontact['linkedin'] ?? null }}
                </a>
            </td>
            <td>
                <a href="{{ $contact->company->fullcontact['twitter'] ?? null }}" target="_blank">
                    {{ $contact->company->fullcontact['twitter'] ?? null }}
                </a>
            </td>
            <td>
                <a href="{{ $contact->company->fullcontact['facebook'] ?? null }}" target="_blank">
                    {{ $contact->company->fullcontact['facebook'] ?? null }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
