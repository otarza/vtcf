# Views Taxonomy Checkbox Filters - Drupal 8 module
This module adds checkbox taxonomy filters to views using contextual filters. 

Reason for creating this module is that https://www.drupal.org/project/better_exposed_filters does not support checkboxes for taxonomies yet. 

This module is work in progress.

## Usage instructions
NOTE: This module is work in progress, so everything is not automaticaly configured, there are some steps you need to do to make sure you get the desire result.

Assuming there is a view of the content which has references to one or more taxonomy vocabularies.
1. Install module;
2. Go to `admin/structure/vtcf_entity`;
3. Click Add VTCF Entity;
4. Label: Input descriptive label for later use(e.g. {View Machine name} {Display Machine name});
5. View name: This must be view machine name;
6. View display name: This mus be the display name where you need to add filters;
7. Taxonomy vocabularies: Choose which taxonomies you need to be present in filters.
8. After choosing vocabularies, taxonomies will appear accordingly.
9. Choose the taxonomies you need to be presented in filters.
10. Go to your view edit page;
11. Add Contextual filter `Has taxonomy term ID`;
12. Configure: `WHEN THE FILTER VALUE IS IN THE URL OR A DEFAULT IS PROVIDED` config;
13. Check `Specify validation criteria`;
14. In Validator choose `Taxonomy term ID`;
15. Under Vocabulary choose the vocabularies you configured in step #7;
16. Multiple arguments: Choose `One or more IDs separated by , or +`
17. Under more check `Allow multiple values` and `Allow multiple filter values to work together` options;

Now your filters should be visible on your view and they should be working. 

Some of thi steps might might be converted to automatic configuration, but for now it works as described above. 