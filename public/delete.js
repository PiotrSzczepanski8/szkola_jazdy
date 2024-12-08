function deleteRow(table, id){
    if(confirm(`czy na pewno chcesz usunąć rekord nr ${id} z tabeli ${table}?`)){
        window.location.href = `../includes/delete_row.php?table=${table}&id=${id}`;
    }
};