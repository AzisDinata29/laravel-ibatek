# TODO: Modify upload.blade.php to display data based on logged-in user ID

## Completed Tasks
- [x] Add semester filter dropdown in the filters section with options: "All Semesters", "1" to "8"
- [x] Update JavaScript filterTable function to include semester filtering logic
- [x] Add event listener for semester filter changes
- [x] Set verification status filter default to "Verified Only"
- [x] Add automatic filtering on page load to show only verified records by default
- [x] Modify RelatedRecordController index method to filter records by current user ID

## Followup Steps
- [ ] Test the filter functionality in the browser to ensure it correctly shows/hides rows based on selected semester
- [ ] Verify that the filter works in combination with other filters (verification status and record type)
- [ ] Confirm that the page loads with only verified records shown by default
- [ ] Verify that only records belonging to the logged-in user are displayed
