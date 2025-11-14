<div>
    <h2 class="text-2xl font-bold text-[var(--burgundy)] mb-6">Dashboard Overview</h2>
    
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_users']) }}</div>
            <div class="text-xs text-gray-600">Total Users</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_videos']) }}</div>
            <div class="text-xs text-gray-600">Total Videos</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['total_articles']) }}</div>
            <div class="text-xs text-gray-600">Total Articles</div>
        </div>
        <div class="bg-white rounded-xl p-4 text-center shadow hover:shadow-lg transition">
            <div class="text-2xl font-bold text-[var(--burgundy)]">{{ number_format($stats['pending_requests']) }}</div>
            <div class="text-xs text-gray-600">Pending Requests</div>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-lg mb-10">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-xl font-bold text-[var(--burgundy)]">📊 User Engagement per Kategori</h3>
                <p class="text-sm text-gray-600 mt-1">Views (Bar) & Comments (Line) pada setiap kategori</p>
            </div>
            <div class="flex gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-[#912f56] rounded"></div>
                    <span class="text-gray-600">Views</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-[#f59e0b] rounded"></div>
                    <span class="text-gray-600">Comments</span>
                </div>
            </div>
        </div>
        
        <div class="relative" style="height: 400px;">
            <canvas id="engagementChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow">
        <h3 class="font-bold text-[var(--burgundy)] mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="{{ route('admin.users') }}" class="btn-main text-center py-3 rounded-lg text-sm">Manage Users</a>
            <a href="{{ route('admin.videos') }}" class="btn-main text-center py-3 rounded-lg text-sm">Manage Videos</a>
            <a href="{{ route('admin.articles') }}" class="btn-main text-center py-3 rounded-lg text-sm">Manage Articles</a>
            <a href="{{ route('admin.requests') }}" class="btn-main text-center py-3 rounded-lg text-sm">View Requests</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('engagementChart');
            
            const chartData = {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        type: 'bar',
                        label: 'Total Views',
                        data: @json($chartData['views']),
                        backgroundColor: 'rgba(145, 47, 86, 0.8)',
                        borderColor: 'rgba(145, 47, 86, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        yAxisID: 'y',
                    },
                    {
                        type: 'line',
                        label: 'Total Comments',
                        data: @json($chartData['comments']),
                        backgroundColor: 'rgba(245, 158, 11, 0.2)',
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        tension: 0.4,
                        yAxisID: 'y1',
                    }
                ]
            };

            new Chart(ctx, {
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 15,
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#6b7280'
                            }
                        },
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Total Views',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                color: '#912f56'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                },
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Total Comments',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                color: '#f59e0b'
                            },
                            grid: {
                                drawOnChartArea: false,
                            },
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('id-ID').format(value);
                                },
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>