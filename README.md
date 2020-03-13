= Example =

== Dumping Database to Master Dump ==

    "scripts": {
        "db:dump:master": [
            "@putenv DUMP_STRIP_ADDITIONAL='tl_search tl_search_index tl_rateit_ratings tl_om_searchkeys tl_om_searchkeys_count tl_comments tl_comment_notify tl_formdata tl_formdata_details'",
            "IMI\\Dev\\DbDump::dumpToMaster"
        ]
    }