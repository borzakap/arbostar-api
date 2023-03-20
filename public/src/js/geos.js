import cascadingDropdown from 'cascadingDropdown';

$('#geos').cascadingDropdown({
    textKey: 'label',
    valueKey: 'value',
    selectBoxes: [
        {
            selector: '.countries',
            paramName: 'c_id',
            url: '/geos/api/countries'
        },
        {
            selector: '.regions',
            requires: ['.countries'],
            paramName: 'r_id',
            url: '/geos/api/regions'
        },
        {
            selector: '.districts',
            requires: ['.countries', '.regions'],
            requireAll: true,
            url: '/geos/api/districts'
        }
    ]
});