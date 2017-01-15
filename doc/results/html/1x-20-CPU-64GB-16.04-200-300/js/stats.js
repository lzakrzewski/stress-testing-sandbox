var stats = {
    type: "GROUP",
name: "Global Information",
path: "",
pathFormatted: "group_missing-name-b06d1",
stats: {
    "name": "Global Information",
    "numberOfRequests": {
        "total": "120000",
        "ok": "53732",
        "ko": "66268"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "32",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60248",
        "ok": "60009",
        "ko": "60248"
    },
    "meanResponseTime": {
        "total": "12060",
        "ok": "16530",
        "ko": "8436"
    },
    "standardDeviation": {
        "total": "17018",
        "ok": "13315",
        "ko": "18744"
    },
    "percentiles1": {
        "total": "2473",
        "ok": "13760",
        "ko": "0"
    },
    "percentiles2": {
        "total": "19668",
        "ok": "22729",
        "ko": "0"
    },
    "percentiles3": {
        "total": "53487",
        "ok": "45603",
        "ko": "56120"
    },
    "percentiles4": {
        "total": "59175",
        "ok": "57146",
        "ko": "59573"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 278,
        "percentage": 0
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 120,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 53334,
        "percentage": 44
    },
    "group4": {
        "name": "failed",
        "count": 66268,
        "percentage": 55
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "313.316",
        "ok": "140.292",
        "ko": "173.023"
    }
},
contents: {
"req_wall-94e8a": {
        type: "REQUEST",
        name: "Wall",
path: "Wall",
pathFormatted: "req_wall-94e8a",
stats: {
    "name": "Wall",
    "numberOfRequests": {
        "total": "60000",
        "ok": "26464",
        "ko": "33536"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "32",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60248",
        "ok": "59999",
        "ko": "60248"
    },
    "meanResponseTime": {
        "total": "9984",
        "ok": "12319",
        "ko": "8142"
    },
    "standardDeviation": {
        "total": "16162",
        "ok": "12578",
        "ko": "18297"
    },
    "percentiles1": {
        "total": "1383",
        "ok": "8015",
        "ko": "0"
    },
    "percentiles2": {
        "total": "10916",
        "ok": "14458",
        "ko": "0"
    },
    "percentiles3": {
        "total": "52596",
        "ok": "43615",
        "ko": "55566"
    },
    "percentiles4": {
        "total": "59086",
        "ok": "57120",
        "ko": "59498"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 148,
        "percentage": 0
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 91,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 26225,
        "percentage": 44
    },
    "group4": {
        "name": "failed",
        "count": 33536,
        "percentage": 56
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "156.658",
        "ok": "69.097",
        "ko": "87.561"
    }
}
    },"req_publishpost-28274": {
        type: "REQUEST",
        name: "PublishPost",
path: "PublishPost",
pathFormatted: "req_publishpost-28274",
stats: {
    "name": "PublishPost",
    "numberOfRequests": {
        "total": "60000",
        "ok": "27268",
        "ko": "32732"
    },
    "minResponseTime": {
        "total": "0",
        "ok": "36",
        "ko": "0"
    },
    "maxResponseTime": {
        "total": "60072",
        "ok": "60009",
        "ko": "60072"
    },
    "meanResponseTime": {
        "total": "14137",
        "ok": "20617",
        "ko": "8738"
    },
    "standardDeviation": {
        "total": "17590",
        "ok": "12724",
        "ko": "19187"
    },
    "percentiles1": {
        "total": "4097",
        "ok": "19901",
        "ko": "0"
    },
    "percentiles2": {
        "total": "22894",
        "ok": "25884",
        "ko": "0"
    },
    "percentiles3": {
        "total": "54170",
        "ok": "46984",
        "ko": "56608"
    },
    "percentiles4": {
        "total": "59247",
        "ok": "57171",
        "ko": "59611"
    },
    "group1": {
        "name": "t < 220 ms",
        "count": 130,
        "percentage": 0
    },
    "group2": {
        "name": "220 ms < t < 320 ms",
        "count": 29,
        "percentage": 0
    },
    "group3": {
        "name": "t > 320 ms",
        "count": 27109,
        "percentage": 45
    },
    "group4": {
        "name": "failed",
        "count": 32732,
        "percentage": 55
    },
    "meanNumberOfRequestsPerSecond": {
        "total": "156.658",
        "ok": "71.196",
        "ko": "85.462"
    }
}
    }
}

}

function fillStats(stat){
    $("#numberOfRequests").append(stat.numberOfRequests.total);
    $("#numberOfRequestsOK").append(stat.numberOfRequests.ok);
    $("#numberOfRequestsKO").append(stat.numberOfRequests.ko);

    $("#minResponseTime").append(stat.minResponseTime.total);
    $("#minResponseTimeOK").append(stat.minResponseTime.ok);
    $("#minResponseTimeKO").append(stat.minResponseTime.ko);

    $("#maxResponseTime").append(stat.maxResponseTime.total);
    $("#maxResponseTimeOK").append(stat.maxResponseTime.ok);
    $("#maxResponseTimeKO").append(stat.maxResponseTime.ko);

    $("#meanResponseTime").append(stat.meanResponseTime.total);
    $("#meanResponseTimeOK").append(stat.meanResponseTime.ok);
    $("#meanResponseTimeKO").append(stat.meanResponseTime.ko);

    $("#standardDeviation").append(stat.standardDeviation.total);
    $("#standardDeviationOK").append(stat.standardDeviation.ok);
    $("#standardDeviationKO").append(stat.standardDeviation.ko);

    $("#percentiles1").append(stat.percentiles1.total);
    $("#percentiles1OK").append(stat.percentiles1.ok);
    $("#percentiles1KO").append(stat.percentiles1.ko);

    $("#percentiles2").append(stat.percentiles2.total);
    $("#percentiles2OK").append(stat.percentiles2.ok);
    $("#percentiles2KO").append(stat.percentiles2.ko);

    $("#percentiles3").append(stat.percentiles3.total);
    $("#percentiles3OK").append(stat.percentiles3.ok);
    $("#percentiles3KO").append(stat.percentiles3.ko);

    $("#percentiles4").append(stat.percentiles4.total);
    $("#percentiles4OK").append(stat.percentiles4.ok);
    $("#percentiles4KO").append(stat.percentiles4.ko);

    $("#meanNumberOfRequestsPerSecond").append(stat.meanNumberOfRequestsPerSecond.total);
    $("#meanNumberOfRequestsPerSecondOK").append(stat.meanNumberOfRequestsPerSecond.ok);
    $("#meanNumberOfRequestsPerSecondKO").append(stat.meanNumberOfRequestsPerSecond.ko);
}
