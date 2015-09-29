<a class="button" href="?export=csv">{ts}Download CSV{/ts}</a>
<table class="crm-group-selector">
    <thead>
    <tr>
        <th>{ts}id{/ts}</th>
        <th>{ts}Site Name{/ts}</th>
        <th>{ts}Site URL{/ts}</th>
        <th>{ts}Timestamp{/ts}</th>
        <th>{ts}Metric Type{/ts}</th>
        <th>{ts}Data{/ts}</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$data item="row"}
        <tr>
            <td>{$row.id}</td>
            <td>{$row.site_name}</td>
            <td>{$row.site_url}</td>
            <td>{$row.timestamp}</td>
            <td>{$row.type}</td>
            <td>{$row.data}</td>
        </tr>
    {/foreach}
    </tbody>
</table>