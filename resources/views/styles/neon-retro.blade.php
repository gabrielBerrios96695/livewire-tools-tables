

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        
        .neon-retro-style {
            width: 100%;
            overflow-x: auto;
            background-color: #0a0a1a;
            color: #e0f8ff;
            padding: 1.5rem;
            border-radius: 0;
            font-family: 'Courier New', monospace;
            border: 2px solid #4d00ff;
            box-shadow: 0 0 15px rgba(77, 0, 255, 0.5);
        }

        .neon-retro-style .table-controls {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .neon-retro-style .table-controls .left-controls,
        .neon-retro-style .table-controls .right-controls {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .neon-retro-style select,
        .neon-retro-style input[type="text"],
        .neon-retro-style button {
            background-color: rgba(10, 10, 30, 0.8);
            color: #00fffc;
            border: 1px solid #4d00ff;
            border-radius: 0;
            padding: 8px 15px;
            font-size: 14px;
            outline: none;
            font-family: 'Courier New', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 0 8px rgba(77, 0, 255, 0.3);
            transition: all 0.3s ease;
        }

        .neon-retro-style select:focus,
        .neon-retro-style input[type="text"]:focus {
            border-color: #00fffc;
            box-shadow: 0 0 12px rgba(0, 255, 252, 0.5);
        }

        .neon-retro-style button {
            background-color: #4d00ff;
            color: #ffffff;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .neon-retro-style button:hover {
            background-color: #6000ff;
            box-shadow: 0 0 15px rgba(77, 0, 255, 0.7);
            text-shadow: 0 0 5px #ffffff;
        }

        .neon-retro-style button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                transparent,
                transparent,
                transparent,
                rgba(0, 255, 252, 0.4),
                transparent
            );
            transform: rotate(30deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: rotate(30deg) translate(-30%, -30%); }
            100% { transform: rotate(30deg) translate(30%, 30%); }
        }

        .neon-retro-style table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
            margin: 1.5rem 0;
            border: 1px solid #4d00ff;
        }

        .neon-retro-style th, .neon-retro-style td {
            border: 1px solid #4d00ff;
            padding: 12px 16px;
            text-align: left;
            vertical-align: middle;
        }

        .neon-retro-style th {
            background-color: rgba(77, 0, 255, 0.2);
            color: #00fffc;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85em;
            letter-spacing: 2px;
            text-shadow: 0 0 5px rgba(0, 255, 252, 0.5);
        }

        .neon-retro-style th.sortable {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .neon-retro-style th.sortable:hover {
            background-color: rgba(77, 0, 255, 0.4);
        }

        .neon-retro-style th.sorted {
            color: #ff00e6;
            background-color: rgba(77, 0, 255, 0.4);
            text-shadow: 0 0 5px rgba(255, 0, 230, 0.7);
        }

        .neon-retro-style .sort-icon {
            margin-left: 8px;
            font-size: 1em;
        }

        .neon-retro-style .th-content {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .neon-retro-style tr:nth-child(even) {
            background-color: rgba(77, 0, 255, 0.05);
        }

        .neon-retro-style tr:hover {
            background-color: rgba(77, 0, 255, 0.15);
        }

        .neon-retro-style .pagination {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .neon-retro-style .pagination button {
            background-color: rgba(77, 0, 255, 0.3);
            color: #00fffc;
            border: 1px solid #4d00ff;
            padding: 8px 15px;
            min-width: 40px;
            cursor: pointer;
            border-radius: 0;
        }

        .neon-retro-style .pagination button:hover {
            background-color: rgba(77, 0, 255, 0.5);
            color: #ffffff;
        }

        .neon-retro-style .pagination .active {
            background-color: #ff00e6;
            color: #0a0a1a;
            font-weight: bold;
            box-shadow: 0 0 15px rgba(255, 0, 230, 0.7);
            border-color: #ff00e6;
        }

        @media screen and (max-width: 768px) {
            .neon-retro-style {
                padding: 1rem;
            }
            
            .neon-retro-style .table-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .neon-retro-style .left-controls,
            .neon-retro-style .right-controls {
                width: 100%;
            }

            .neon-retro-style .right-controls {
                justify-content: flex-start;
            }

            .neon-retro-style table {
                min-width: 600px;
            }
        }
    </style>