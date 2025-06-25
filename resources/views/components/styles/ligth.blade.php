<style>
    .tools-table-container.light-style {
        background-color: #ffffff;
        color: #1a202c;
        border-radius: 0.5rem;
        overflow: hidden;
        padding: 1rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
                    0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .tools-table-container.light-style .tools-data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .tools-table-container.light-style th,
    .tools-table-container.light-style td {
        padding: 1rem;
        text-align: left;
    }

    .tools-table-container.light-style th {
        background-color: #f7fafc;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e2e8f0;
    }

    .tools-table-container.light-style td {
        border-bottom: 1px solid #edf2f7;
    }

    .tools-table-container.light-style tr:hover td {
        background-color: #f8fafc;
    }

    .tools-table-container.light-style .sortable {
        transition: background-color 0.2s ease;
    }

    .tools-table-container.light-style .sortable:hover {
        background-color: #ebf8ff;
        cursor: pointer;
    }

    .tools-table-container.light-style .sorted {
        color: #3182ce;
    }

    .tools-table-container.light-style .sort-icon {
        margin-left: 0.5rem;
        font-size: 0.8em;
    }

    .tools-table-container.light-style .th-content {
        display: flex;
        align-items: center;
    }
</style>